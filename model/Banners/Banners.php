<?php
class Banners
{

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function setAttribute()
    {
        $ordering = [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Gender',
            'url' => 'Phone',
            'target'=>'Target',
            'status'=>'Status',
            'image'=>'Image',
            'created_time' => 'Created at',
            'updated_time' => 'Updated at'
        ];

        return $ordering;
    }
}
?>
