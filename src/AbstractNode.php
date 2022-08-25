<?php

namespace Mav\Optimacros;

use JetBrains\PhpStorm\ArrayShape;

abstract class AbstractNode implements INode
{

    private string $name;
    private string $type;
    private string $parentName;
    private string $relation;
    public array $children;
    public INode|null $parent;

    public function __construct(string $name,string $type,string $parentName, string $relation)
    {
        $this->name = $name;
        $this->type = $type;
        $this->parentName = $parentName;
        $this->relation = $relation;
        $this->children = [];
        $this->parent = null;
    }


    public function getName(): string
    {
        return $this->name;
    }

    #[ArrayShape(["itemName" => "string", "parent" => "string", "children" => "array|null"])]
    public function toArray(): array
    {
        return[
            "itemName"=> $this->getName(),
            "parent"=> $this->parentName,
            "children"=> isset($this->children)?array_map(fn($item) => $item->toArray(),$this->children):null
        ];
    }


    /**
     * @param INode $parent
     *
     * @return AbstractNode
     */
    public function setParent(INode $parent): static
    {
        $this->parent = $parent;
        $parent->addChild($this);
        return $this;
    }

    public function addChild(INode $item): static
    {
        // исключить дублирование
        if(!in_array($item,$this->children)) {
            $this->children[] = $item;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getParentName(): string
    {
        return $this->parentName;
    }

    /**
     * @return string
     */
    public function getRelation(): string
    {
        return $this->relation;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}

