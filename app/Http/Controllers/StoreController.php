<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\ToggleSellerRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Services\ApiGateway;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Response;
use Propaganistas\LaravelPhone\PhoneNumber;

class StoreController extends Controller
{
    use ApiResponser;
    /**
     * Lista de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->httpOkResponse(Store::with('sellers')->get());
    }

    /**
     * Crea un registro del recurso
     *
     * @param  App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $data = $request->all();
        $data['whatsapp'] = PhoneNumber::make($request->whatsapp, 'CO');
        $store = Store::create($data);
        Seller::create([
            'admin' => '1',
            'priority' => 1,
            'seller_id' => $request->admin,
            'store_id' => $store->id,
        ]);
        $store->sellers;

        try {
            $response = ApiGateway::performRequest('POST', '/api/file', [
                'file' => $request->file,
                'location' => 'public/store/'.$store->id.'/images',
                'name' => 'logo'.time().'.'.$request->file('file')->clientExtension(),
                'item_type' => 'store_logo',
                'item' => $store->id
            ]);

            if ($response['code'] == Response::HTTP_CREATED) {
                $store->update([
                    'file_id' => $response['data']['id']
                ]);
                return $this->generateResponse($store, Response::HTTP_CREATED);
            } else {
                return $this->generateResponse('Error desconocido almacenando archivo', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } catch(Exception $d) {
            $store->sellers()->delete();
            $store->delete();
            return $this->generateResponse('Error desconocido almacenando archivo', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Obtiene el recurso especificado
     *
     * @param  App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $store->sellers;
        return $this->httpOkResponse($store);
    }

    /**
     * Actualiza un recurso especifico
     *
     * @param  App\Http\Requests\UpdateStoreRequest  $request
     * @param  App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $data = $request->all();
        $data['whatsapp'] = PhoneNumber::make($request->whatsapp, 'CO');
        $store->update($data);

        // Se elimina el actual administrador y el vendedor nuevo admin
        // si ya estaba asociado a la tienda
        $store->sellers()
        ->where(function ($q) use ($request) {
            $q->where('sellers.id', $request->admin)
            ->orWhere('sellers.admin', '1');
        })
        ->delete();

        Seller::create([
            'admin' => '1',
            'priority' => 1,
            'seller_id' => $request->admin,
            'store_id' => $store->id,
        ]);

        $store->sellers;

        if ($request->has('file')) {
            try {
                ApiGateway::performRequest('PUT', '/api/file/'.$store->file_id, [
                    'file' => $request->file,
                    'location' => 'public/store/'.$store->id.'/images',
                    'name' => 'logo_'.time().'.'.$request->file('file')->clientExtension(),
                    'item_type' => 'store_logo',
                    'item' => $store->id
                ]);

                return $this->generateResponse($store, Response::HTTP_CREATED);
            } catch(Exception $d) {
                return $this->generateResponse('Error desconocido almacenando archivo', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        return $this->httpOkResponse($store);
    }

    /**
     * Elimina un recurso especifico
     *
     * @param  App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        ApiGateway::performRequest('DELETE', '/api/file/'.$store->file_id, []);
        $store->sellers()->delete();
        $store->delete();
        return $this->httpOkResponse();
    }

    /**
     * Descarga logo de la tienda
     *
     * @param  App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function downloadLogo(Store $store)
    {
        return ApiGateway::performRequest('GET', '/api/file/download/'.$store->file_id, [], true);
    }

    /**
     * Alterna a un vendedor en una tienda
     *
     * @param ToggleSellerRequest $request
     * @return void
     */
    public function toggleSeller(ToggleSellerRequest $request)
    {
        $seller = Seller::where('store_id', $request->store)
        ->where('seller_id', $request->seller)->first();

        if ($seller) {
            $seller->delete();
        } else {
            Seller::create([
                'admin' => '0',
                'priority' => 1,
                'seller_id' => $request->seller,
                'store_id' => $request->store,
            ]);
        }
        return $this->httpOkResponse();
    }
}
