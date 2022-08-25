<?php

namespace Mav\Optimacros;

class Handler
{
    private string $fileNameOutput;
    private string $fileName;
    /**
     * @var array Node
     */
    private array $nodes = [];

    public function __construct(string $fileName, string $fileNameOutput = 'output.txt')
    {
        $this->fileName = $fileName;
        $this->fileNameOutput = $fileNameOutput;
        $this->parseFile();
        $this->collect();
        $this->exportJson();
    }

    private function parseFile(){

        $items = file($this->fileName);

        // убрать заголовки
        array_shift($items); //"Item Name";"Type";"Parent";"Relation"

        foreach ($items as $item) {
            $item = str_getcsv($item,';');
            $itemName = $item[0];
            if(empty($itemName)) continue;
            $this->nodes[$itemName] = new Node($itemName, $item[1], $item[2], $item[3]);
        }

    }

    private function collect(){
        /** @var INode $item */
        foreach ($this->nodes as $item) {

            $parentName = $item->getParentName();
            if (!empty($parentName) && isset($this->nodes[$parentName])) {
                $parent = $this->nodes[$parentName];
                $item->setParent($parent);
            }
            $relation = $item->getRelation();
            if($item->getType()=='Прямые компоненты' && !empty($relation) && isset($this->nodes[$relation])){
                $item->addChild($this->nodes[$relation]);
            }
        }

    }

    private function exportJson(){
        file_put_contents($this->fileNameOutput,json_encode($this->nodes['Total']->toArray(),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

}