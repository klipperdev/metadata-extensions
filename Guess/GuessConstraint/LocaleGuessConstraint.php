<?php

/*
 * This file is part of the Klipper package.
 *
 * (c) François Pluchino <francois.pluchino@klipper.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Klipper\Component\MetadataExtensions\Guess\GuessConstraint;

use Klipper\Component\Metadata\ChildMetadataBuilderInterface;
use Symfony\Component\Intl\Locales;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Locale;

/**
 * @author François Pluchino <francois.pluchino@klipper.dev>
 */
class LocaleGuessConstraint extends AbstractGuessConstraint
{
    public function supports(ChildMetadataBuilderInterface $builder, Constraint $constraint): bool
    {
        return $constraint instanceof Locale;
    }

    /**
     * @param Constraint|Locale $constraint
     */
    public function guess(ChildMetadataBuilderInterface $builder, Constraint $constraint): void
    {
        $choices = Locales::getNames();

        $this->addType($builder, '?string');
        $this->addInput($builder, 'choice', [
            'choices' => array_keys($choices),
            'multiple' => false,
            'null_form_type' => true,
        ]);
    }
}
