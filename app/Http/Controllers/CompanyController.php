<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Media;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    //

    public function index()
    {
        // $companies = new Company();
        $companies= DB::table('company')->get();
         $medias = DB::table('company')
          ->join('media', 'media.company_id', '=', 'company.company_id')->get();
        // ->SELECR
       // dd($companies);//
        // $medias = Media::all()->where('company_id', $company_id)
        //dd($companies);
    //    return view('companies',[
    //     'companies' => $companies
    // ]);
    return view('/companies',compact('companies','medias'));
    //dd($companies, $medias);
    }


// POSTING NEW COMPANY
    public function addCompany()
    {
        $this->validate(request(), [
            'companyName'=> 'required | max:50',
        ], ['companyName.required' => 'company name is required']);
        $req=request();
        $form_req=$req->all();
        
        $companies=new Company();

        $companies->companyName = $form_req['companyName'];
        $status=$companies->save();
        return redirect()->to('companies')->withSuccess('New company had been added!!');

    }

    // RETRIEVING COMPANIES
    public function getCompany(){
        $companies = new Company();
        $companies = $companies-> get();
        
        return redirect()->to('companies',[
            'companies' => $companies
        ]
            );
    }
}
