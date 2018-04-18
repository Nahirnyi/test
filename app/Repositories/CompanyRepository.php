<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 20:39
 */

namespace App\Repositories;

use App\Company;

class CompanyRepository
{
    /**
     * @param $data
     * @return Company
     */
    public function add($data) : Company
    {
        $company = new Company();
        $company->name = $data['name'];
        $company->owner_id = $data['owner_id'];
        $company->save();

        return $company;
    }

    /**
     * @return Company
     */
    public function all() : Company
    {
        $companies = Company::all();

        return $companies;
    }

    /**
     * @param $company
     * @param $data
     * @return Company
     */
    public function update($company, $data):Company
    {
        $company->name = $data['name'];
        $company->owner_id = $data['owner_id'];
        $company->save();

        return $company;
    }

    /**
     * @param $company
     */
    public function delete($company)
    {
        $company->delete();
    }
}