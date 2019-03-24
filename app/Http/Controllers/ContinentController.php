<?php

namespace App\Http\Controllers;


use App\Continent;
use App\DataAccessLayer\DALFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContinentController extends ApiController
{
    public function GetContinents(Request $request)
    {
        $rules = [
            'PageNumber' => 'required|integer',
            'PageSize' => 'required|integer|max:50',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $query = Continent::query();
        $continents = DALFacade::ContinentRepository()->list($query, $data['PageNumber'], $data['PageSize'], null);
        if ($continents)
            return $this->CollectionResponse($continents);

        return $this->error('Ops.. something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function GetContinent(Request $request)
    {
        $rules = [
            'ContinentId' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $continent = DALFacade::ContinentRepository()->get($data['ContinentId']);
        if ($continent)
            return $this->success($continent);
        else
            return $this->error('Not found', Response::HTTP_NOT_FOUND);
    }

    public function AddContinent(Request $request)
    {
        $rules = [
            'Name' => 'required|string|max:50',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $continent = new Continent();
        $continent->name = $data['Name'];
        if (DALFacade::ContinentRepository()->add($continent) > 0)
            return $this->success(null);

        return $this->error('Ops.. something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function UpdateContinent(Request $request)
    {
        $rules = [
            'ContinentId' => 'required|integer',
            'Name' => 'string|nullable|max:50',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $continent = DALFacade::ContinentRepository()->get($data['ContinentId']);
        if ($continent)
        {
            if($request->has('Name'))
            {
                $continent->name = $data['Name'];
            }
            if (DALFacade::ContinentRepository()->update($continent))
            {
                return $this->success($continent);
            }
            else
                return $this->error('Ops.. something went wrong', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
            return $this->error('Not found', Response::HTTP_NOT_FOUND);
    }

    public function DeleteContinent(Request $request)
    {
        $rules = [
            'ContinentId' => 'required|integer',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        if (DALFacade::ContinentRepository()->delete($data['ContinentId']))
            return $this->success(null);
        else
            return $this->error('Not found', Response::HTTP_NOT_FOUND);
    }
}