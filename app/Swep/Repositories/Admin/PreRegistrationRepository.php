<?php


namespace App\Swep\Repositories\Admin;

use App\Models\User\PreRegistrationModel;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\PreRegistrationInterface;

class PreRegistrationRepository extends BaseRepository implements PreRegistrationInterface
{
    protected $preRegistration;

    public function __construct(PreRegistrationModel $preRegistration)
    {
        $this->preRegistration = $preRegistration;
        parent::__construct();
    }

//    public function fetchTable($data){
//        $get = $this->preRegistration;
//        return $get->all();
//    }

    public function fetchTable($data)
    {
        return $this->preRegistration
            ->orderByRaw("CASE WHEN status = 'FOR APPROVAL' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc');
//            ->get();
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