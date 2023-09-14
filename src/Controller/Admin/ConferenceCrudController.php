<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

/**
 * Retrieves the fully qualified class name of the entity associated with this function.
 *
 * @return string
 */
class ConferenceCrudController extends AbstractCrudController
{
    /**
     * Retrieves the fully qualified class name of the entity.
     *
     * @return string The fully qualified class name.
     */
    public static function getEntityFqcn(): string
    {
        return Conference::class;
    }

    /**
     * Configures the filters.
     *
     * @param Filters $filters The filters object.
     * @return Filters The configured filters object.
     */
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('city')
            ->add(BooleanFilter::new('isInternational'));
    }
}
