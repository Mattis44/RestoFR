<?php

namespace modele\metier;

class Type {
    
    
private ?int $idTC;
private ?string $labelTC;

function __construct(?int $idTC, ?string $labelTC) {
    $this->idTC = $idTC;
    $this->labelTC = $labelTC;
}

public function __toString() {
    return $this->labelTC;
}

public function getIdTC(): ?int {
    return $this->idTC;
}

public function getLabelTC(): ?string {
    return $this->labelTC;
}

public function setIdTC(?int $idTC): void {
    $this->idTC = $idTC;
}

public function setLabelTC(?string $labelTC): void {
    $this->labelTC = $labelTC;
}





}
