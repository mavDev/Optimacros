<?php

use Mav\Optimacros\AbstractNode;
use Mav\Optimacros\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{

    private Node $obj;
    private Node $objChild;

    protected function setUp(): void
    {
//        "Total";"Изделия и компоненты";;
        $this->obj = new Node("Total","Изделия и компоненты",'','');
        $this->objChild = new Node("ПВЛ","Изделия и компоненты","Total",'');
        $this->objChild->setParent($this->obj);
    }


    public function testCreateFine(){

        $this->assertInstanceOf(AbstractNode::class, $this->obj);

    }

    public function testSetParent(){

        $this->assertEquals($this->objChild->parent,$this->obj);
        $this->assertTrue(in_array($this->objChild,$this->obj->children));

    }

    public function testToArray(){
        $this->assertIsArray($this->obj->toArray());
    }

}