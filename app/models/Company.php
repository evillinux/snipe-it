<?php
class Company extends Elegant
{
	use SoftDeletingTrait;
	protected $dates = ['deleted_at'];

    protected $rules = array(
        'name'              => 'required|alpha_space|min:3|max:255|unique:companies,name,{id}',
    );

    public function assets()
    {
        return $this->hasMany('Asset', 'company_id');
    }

    public function num_assets()
    {
        return $this->hasMany('Asset', 'company_id')->count();
    }
	
}
