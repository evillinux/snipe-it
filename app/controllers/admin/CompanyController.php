<?php namespace Controllers\Admin;

use AdminController;
use Image;
use Input;
use Lang;
use Company;
use Redirect;
use Setting;
use DB;
use Depreciation;
use Manufacturer;
use Sentry;
use Str;
use Validator;
use View;

class CompanyController extends AdminController
{
    /**
     * Show a list of all suppliers
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the suppliers
        $companies = Company::orderBy('created_at', 'DESC')->get();

        // Show the page
        return View::make('backend/company/index', compact('companies'));
    }


    /**
     * Supplier create.
     *
     * @return View
     */
    public function getCreate()
    {
        return View::make('backend/company/edit')->with('company', new Company);
    }


    /**
     * Supplier create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {

        // get the POST data
        $new = Input::all();

        // Create a new supplier
        $company = new Company;

        // attempt validation
        if ($company->validate($new)) {

            // Save the location data
            $company->name                 = e(Input::get('name'));
           
			// Was it created?
            if($company->save()) {
                // Redirect to the new supplier  page
                return Redirect::to("admin/settings/company")->with('success', Lang::get('admin/company/message.create.success'));
            }
        } else {
            // failure
            $errors = $company->errors();
            return Redirect::back()->withInput()->withErrors($errors);
        }

        // Redirect to the supplier create page
        return Redirect::to('admin/settings/company/create')->with('error', Lang::get('admin/company/message.create.error'));

    }

    /**
     * Supplier update.
     *
     * @param  int  $supplierId
     * @return View
     */
    public function getEdit($companyId = null)
    {
        // Check if the supplier exists
        if (is_null($company = Company::find($companyId))) {
            // Redirect to the supplier  page
            return Redirect::to('admin/settings/company')->with('error', Lang::get('admin/company/message.does_not_exist'));
        }

        // Show the page
        return View::make('backend/company/edit', compact('company'));
    }


    /**
     * Supplier update form processing page.
     *
     * @param  int  $supplierId
     * @return Redirect
     */
    public function postEdit($companyId = null)
    {
        // Check if the supplier exists
        if (is_null($company = Company::find($companyId))) {
            // Redirect to the supplier  page
            return Redirect::to('admin/settings/company')->with('error', Lang::get('admin/company/message.does_not_exist'));
        }


          //attempt to validate
        $validator = Validator::make(Input::all(), $company->validationRules($companyId));

        if ($validator->fails())
        {
            // The given data did not pass validation           
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        // attempt validation
        else {

            // Save the  data
            $company->name                 = e(Input::get('name'));
            
			// Was it created?
            if($company->save()) {
                // Redirect to the new supplier page
                return Redirect::to("admin/settings/company")->with('success', Lang::get('admin/company/message.update.success'));
            }
        } 

        // Redirect to the supplier management page
        return Redirect::to("admin/settings/company/$companyId/edit")->with('error', Lang::get('admin/company/message.update.error'));

    }

    /**
     * Delete the given supplier.
     *
     * @param  int  $supplierId
     * @return Redirect
     */
    public function getDelete($companyId)
    {
        // Check if the supplier exists
        if (is_null($company = Company::find($companyId))) {
            // Redirect to the suppliers page
            return Redirect::to('admin/settings/company')->with('error', Lang::get('admin/company/message.not_found'));
        }

        if ($company->num_assets() > 0) {

            // Redirect to the asset management page
            return Redirect::to('admin/settings/company')->with('error', Lang::get('admin/company/message.assoc_users'));
        } else {

            // Delete the supplier
            $company->delete();

            // Redirect to the suppliers management page
        return Redirect::to('admin/settings/company')->with('success', Lang::get('admin/company/message.delete.success'));
        }

    }


    /**
    *  Get the asset information to present to the supplier view page
    *
    * @param  int  $assetId
    * @return View
    **/
    public function getView($companyId = null)
    {
        $company = Company::find($companyId);

        if (isset($company->id)) {
                return View::make('backend/company/view', compact('company'));
        } else {
            // Prepare the error message
            $error = Lang::get('admin/company/message.does_not_exist', compact('id'));

            // Redirect to the user management page
            return Redirect::route('company')->with('error', $error);
        }


    }



}
