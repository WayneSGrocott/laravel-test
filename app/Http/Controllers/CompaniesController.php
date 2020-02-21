<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyStatus;
use App\CompanyType;
use App\Http\Requests\CreateCompany;
use App\Http\Requests\UpdateCompany;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact(['companies']));
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company;
        $companyTypes = CompanyType::pluck('name', 'id');
        $companyStatuses = CompanyStatus::pluck('name', 'id');
        return view('companies.create', compact(['company', 'companyTypes', 'companyStatuses']));
    }

    /**
     *
     * @param CreateCompany $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompany $request)
    {
        Company::create($request->all());
        return redirect('companies')->with('alert', 'Company created!');
    }

    /**
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $companyTypes = CompanyType::pluck('name', 'id');
        $companyStatuses = CompanyStatus::pluck('name', 'id');
        return view('companies.edit', compact(['company', 'companyTypes', 'companyStatuses']));
    }

    /**
     *
     * @param UpdateCompany $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        $company->update($request->all());
        return redirect('companies')->with('alert', 'Company updated!');
    }

    /**
     * Return list of contacts assigned to company
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getContacts($id)
    {
        $company = Company::find($id);

        return $company->contacts->pluck('full_name', 'id');
    }

}
