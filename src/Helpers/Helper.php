<?php

function block($data, $block_name){

    try{

        $_block = false;
        foreach($data->blocks as $block){

            if($block->block_name == trim($block_name)){
                return $block;
            }
        }
        return $_block;
    }catch(Exception $e){
        \Log::info('Something went wrong while pulling out the page block');
        return false;
    }

    return false;
}

function group($data){

    try{

        $_groups = [];

        if($data->multiple == 1){

            if(isset($data->groups))
            {
                foreach($data->groups as $group){

                    if($elements = elements($group)){

                        $_groups[] = (object) $elements;
                    }
                }
            }

            return (object)$_groups;
        }else{

            if(isset($data->groups))
            {
                $group = $data->groups[0];

                if($elements = elements($group)){

                    return (object) $elements;
                }
            }
        }

    }catch(Exception $e){
        \Log::info('Something went wrong while pulling out the page group');
        return false;
    }
    return false;
}

function elements($group){

    if(isset($group)){

        $elements = [];

        foreach($group->elements as $element){

            $elements[$element->name] = (object) $element->toArray();
        }

        return (object) $elements;
    }

    return false;
}