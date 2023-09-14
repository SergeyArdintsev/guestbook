<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CommentCrudController extends AbstractCrudController
{
    /**
     * Retrieves the fully qualified class name of the entity associated with this function.
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    /**
     * Configure the CRUD operations for the given Crud object.
     *
     * @param Crud $crud The Crud object to be configured.
     * @return Crud The configured Crud object.
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference Comment')
            ->setEntityLabelInPlural('Conference Comments')
            ->setSearchFields(['author', 'text', 'email'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }

    /**
     * Generate the function comment for the given function body.
     *
     * @param Filters $filters The Filters object to configure.
     * @return Filters The configured Filters object.
     */
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('conference'))
            ->add('author')
            ->add('email')
        ;
    }

    /**
     * Configures the fields for the given page.
     *
     * @param string $pageName The name of the page.
     * @return iterable The configured fields.
     */
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('conference');
        yield TextField::new('author');
        yield EmailField::new('email');
        yield TextareaField::new('text')
            ->hideOnIndex()
        ;

        $createdAtField = DateTimeField::new('createdAt')
            ->setFormTypeOptions([
                'years' =>  range(date('Y'), date('Y') + 5),
                'widget' => 'single_text',
            ]);
        if (Crud::PAGE_INDEX === $pageName) {
            yield $createdAtField->setFormTypeOptions(['disabled' => true]);
        } else {
            yield $createdAtField;
        }
    }
}
