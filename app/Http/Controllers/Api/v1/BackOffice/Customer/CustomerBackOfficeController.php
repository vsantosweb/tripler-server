<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerBackOfficeController extends Controller
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($dataForRegister)
    {
        try {
            $validationRegisterCustomer = Validator::make(
                $dataForRegister->all(),
                [
                    "name" => "bail|required|string",
                    "email" => "bail|required|email|unique:customers",
                    "password" => "bail|required|min:8",
                    "password_confirm" => "bail|same:password",
                    'rg' => 'nullable',
                    'cpf' => 'nullable',
                ],
                [
                    "required" => "O campo :attribute não pode ser nulo ou vazio.",
                    "unique" => "Esse email já está cadastrado no nosso sistema.",
                    "email" => "o email está incorreto, verifique e tente novamente.",
                    "min" =>  "A senha deve ter no minimo oito caracteres.",
                    "date" => "O formato da data está incorreto, verifique e tente novamente.",
                    "same" => "As senhas não conferem, verifique e tente novamente.",
                ]
            );
            $outputError = $validationRegisterCustomer->errors()->first();

            if ($validationRegisterCustomer->fails()) {
                return $this->outputJSON('', $outputError, 'true', 500);
            }


            $registerCustomer = $this->customer->firstOrCreate(
                ["uuid" => Str::uuid()],
                $dataForRegister->all()
            );

            if (isset($registerCustomer)) {
                return $this->outputJSON($registerCustomer, 'Usuário cadastrado com sucesso!', 'false', 200);
            }

            return $this->outputJSON('', 'Erro ao cadastrar o usuário!', 'true', 500);
        } catch (\Exception $e) {
            return $this->outputJSON('', $e->getMessage(), 'true', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
