<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; //名前空間 Contactモデルを追加
use Illuminate\Support\Facades\Mail; //ファサード追加
use App\Mail\ContactForm;  //追加

class ContactController extends Controller
{
  public function create()
  {
    return view('contact.create');
  }

  public function store(Request $request)
  {
    $inputs=[];
    $inputs=$request->all();
    $inputs=request()->validate([  //title,body,emailなどのバリデーションを設定し、$inputs(変数)として使用する($inputsに代入)
      'title'=>'required|max:255',
      'email'=>'required|email|max:255', //記述に注意!!('required|max:255'だとエラーになる)
      'body'=>'required|max:1000',
    ]);
    Contact::create($inputs); //Contactモデルを通じて$inputs(title,body,emailなどのバリデーションを定義した変数)を反映させながらdbレコードを作成する

    Mail::to(config('mail.admin'))->send(new ContactForm($inputs));  //laravel備え付けのtoメソッドを呼び出している(ファザード)
    Mail::to($inputs['email'])->send(new ContactForm($inputs));  //toメソッドでemailの情報をContactFormに渡す

    return back()->with('message','メールを送信したのでご確認ください'); //送信後メッセージを出して直前の画面に戻る
  }
}
