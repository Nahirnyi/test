<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 20:39
 */

namespace App\Repositories;

use App\Company;
use Illuminate\Support\Collection;

class CompanyRepository
{
    /**
     * @param array $data
     * @return Company
     */
    public function add(array $data) : Company
    {
        $company = new Company($data);
        $company->owner_id = $data['owner_id'];
        $company->save();

        return $company;
    }

    /**
     * @return Collection
     */
    public function all() : Collection
    {
        $companies = Company::all();

        return $companies;
    }

    /**
     * @param Company $company
     * @param array $data
     * @return Company
     */
    public function update(Company $company, array $data) : Company
    {
        $company->fill($data);
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