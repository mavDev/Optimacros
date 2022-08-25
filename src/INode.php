<?php

namespace Mav\Optimacros;

interface iNode
{

    public function getName(): string;

    public function toArray(): array;

    public function setParent(iNode $parent): static;

    public function addChild(iNode $item): static;

    public function getParentName(): string;

    public function getRelation(): string;

}

