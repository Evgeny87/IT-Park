<?php

namespace Controllers;

class GuestController
{
    public function all()
    {
        return 'Все гости';
    }

    public function getById($id)
    {
        return 'Гость c ID '. $id;
    }
}