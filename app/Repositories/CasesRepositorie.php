<?php


namespace App\Repositories;


use App\Models\Cases;
use Illuminate\Support\Facades\Auth;


class CasesRepositorie
{
    protected $cases;
    public function __construct(Cases $cases)
    {
        $this->cases = $cases;
    }


    public function get_my_cases()
    {
        $cases = Auth::user()->cases()->get();
        return $cases;
    }

    public function show_continue_edit($id)
    {
        return $case = Auth::user()->cases()->find($id);
    }
}
