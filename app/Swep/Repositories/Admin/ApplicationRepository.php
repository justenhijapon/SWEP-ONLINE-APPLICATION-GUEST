<?php


namespace App\Swep\Repositories\Admin;

use App\Models\User\ImportedCommodities;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\ApplicationInterface;

class ApplicationRepository extends BaseRepository implements ApplicationInterface {
    protected $application;

    public function __construct(ImportedCommodities $application)
    {
        $this->application = $application;
        parent::__construct();
    }

//    public function fetchTable($data){
//        $get = $this->application;
//        return $get->all();
//    }

    public function fetchTable($data)
    {
        return $this->application->where('submission', 1); // Return query instead of collection
    }

    public function fetch($request)
    {
        // TODO: Implement fetch() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $slug)
    {
        // TODO: Implement update() method.
    }

    public function destroy($slug)
    {
        // TODO: Implement destroy() method.
    }
}