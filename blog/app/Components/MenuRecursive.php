<?php

namespace App\Components;

use App\Menu;

class MenuRecursive {
    private $html;
    public function __construct()
    {
        $this->html = '';
    }
    public function menuRecursiveAdd($parentId = 0, $SubMark = '') {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' .$dataItem->id. '">' . $SubMark .$dataItem->name. '</option>';
            $this->menuRecursiveAdd($dataItem->id, $SubMark . '--');
        }
        return $this->html;
    }

    public function menuRecursiveEdit ($parentIdMenuEdit, $parentId = 0, $SubMark = '') {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            if ($parentIdMenuEdit == $dataItem->id) {
                $this->html .= '<option selected value="' .$dataItem->id. '">' . $SubMark .$dataItem->name. '</option>';
            } else {
                $this->html .= '<option value="' .$dataItem->id. '">' . $SubMark .$dataItem->name. '</option>';
            }
            $this->menuRecursiveEdit($parentIdMenuEdit, $dataItem->id, $SubMark . '--');
        }
        return $this->html;
    }

}

