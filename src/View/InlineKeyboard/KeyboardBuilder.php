<?php

namespace Turkishjoe\TelegramEngine\View\InlineKeyboard;

use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;

class KeyboardBuilder
{
    protected $buttons = [];
    protected $row = [];

    public function addRow(){
        $this->buttons[] = $this->row;
        $this->row = [];
    }

    public function addButton($text, $data){
        $this->row[] = ['text'=>$text, 'callback_data'=>json_encode($data)];
    }

    public function create(){
        if(!empty($this->row)){
            $this->addRow();
        }

        return new InlineKeyboardMarkup($this->buttons);
    }

    /**
     * FOR ERROS
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }
}
