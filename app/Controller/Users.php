<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Users
{
    public function users(): string
    {
        $users = User::all();
        return (new View()) -> render('site.users', ['users'=>$users]);
    }
    public function deluser(Request $request): string
    {
        if($request->method === 'POST' && User::where('id', $request->id)->delete()){
            app()->route->redirect('/users');
        }
        return new View('site.delUser');
    }
    public function upduser(Request $request): string
    {
        $user = User::where('id', $request->id)->first();
        if($request->method === 'POST'){
            $validator = new Validator($request->all(), [
                'name' => ['required', 'cyrillic'],
                'surname' => ['required', 'cyrillic'],
                'patronymic' => ['required', 'cyrillic'],
                'job_title' => ['required'],
                'email' => ['required', 'unique:users,email', 'email'],
                'password' => ['required', 'latin'],
                'filename' => ['img']
            ], [
                'required' => 'В поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'img' => 'Расширение файла должно быть .jpg (jpeg, png)',
                'cyrillic' => 'В поле :field присутствует латиница',
                'email' =>'В поле :field должен быть символ \'@\'',
                'latin'=>'В поле :field присутствует кириллица'
            ]);

            if ($validator->fails()) {
                return new View('site.updUser',
                    ['message' => $validator->errors(),
                        ['user' => $user]]);
            }else{
                User::where('id', $request->id)->update(['name' => $request->name,
                    'surname' => $request->surname,
                    'patronymic' => $request->patronymic,
                    'phone' => $request->phone,
                    'job_title' => $request->job_title,
                    'email' => $request->email,
                    'password' => md5($request->password)]);
                app()->route->redirect('/users');
            }
        }
        return new View('site.updUser', ['user'=>$user]);
    }
}