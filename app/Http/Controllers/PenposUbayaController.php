<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenposUbayaController extends Controller
{
    //bank
    public function opsiHutang(){
        return view("penpos.ubaya.bank");
    }

    //commodity
    public function opsiKomoditas(){
        return view("penpos.ubaya.commodity");
    }

    //factory
    public function opsiProduk(){
        return view("penpos.ubaya.factory");
    }

    //heritage
    public function opsiHeritage(){
        return view("penpos.ubaya.heritage");
    }
}
