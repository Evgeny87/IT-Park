<?php

class GuestController
{
    public function all()
    {
        echo 'Все гости';
    }

    public function getById($id)
    {
        echo 'Гость c ID '. $id;
    }
}