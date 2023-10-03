## CÓDIGO CONTROLADOR DAS FUNÇÕES DO FUNCIONARIO
```php
    /**
     * Mostra a lista de funcionários / usuarios cadastrados
     */
    public function listActiveUsers()
    {
        try {
            $service = new ListActiveUsersService();
            $response = $service->listUsers();
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
```

```php
    /**
     * Mostra um usuario em especifico.
     */
    public function findUser(int $id)
    {
        try {
            $service = new FindUserService();
            $response = $service->findUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }

    }

```

```php
    /**
     * Cadastra os novos funcionarios no sistema.
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'ctps' => 'required',
            'pis' => 'required',
            'company_id' => 'required',
            'role_id' => 'required',
        ]);

        try {
            $service = new CreateUserService(
                $request->name,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id
            );

            $response = $service->createUser();
            return response()->json(['status' => 'success', 'data' => $response], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
```

```php
    /**
     * Atualiza um funcionario no sistema.
     */
    public function updateUser(Request $request, int $id)
    {
        $request->validate([
            'name' => 'string',
            'cpf' => 'string',
            'ctps' => 'string',
            'pis' => 'string',
            'company_id' => 'integer',
            'role_id' => 'integer',
        ]);

        try {
            $service = new UpdateUserService(
                $request->name,
                $request->cpf,
                $request->ctps,
                $request->pis,
                $request->company_id,
                $request->role_id
            );

            $response = $service->updateUser($id);
            return response()->json(['status' => 'success', 'data' => $response], 204);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
```

```php

    /**
     * Deleta um funcionário do sistema.
     */
    public function deleteUser(int $id)
    {
        try {
            //code...
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()], 500);
        }
    }
}```
