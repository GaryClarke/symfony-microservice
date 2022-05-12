<?php

namespace App\Filter\Modifier\Factory;

use App\Filter\Modifier\PriceModifierInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class PriceModifierFactory implements PriceModifierFactoryInterface
{
    public function create(string $modifierType): PriceModifierInterface
    {
        // Convert type (snake_case) to ClassName (PascalCase)
        $modifierClassBasename = str_replace('_', '', ucwords($modifierType, '_'));

        $modifier = self::PRICE_MODIFIER_NAMESPACE . $modifierClassBasename;

        if (!class_exists($modifier)) {

            throw new ClassNotFoundException($modifier);
        }

        return new $modifier();
    }
}