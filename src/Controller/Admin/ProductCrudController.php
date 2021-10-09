<?php
 
namespace App\Controller\Admin;
 
use App\Entity\User;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
 
class ProductCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
 
    public function configureFields(string $pageName): iterable
    {
       /* $user = new User();
        if ($user->getRoles() == ["ROLE_ADMIN"]) {
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                ImageField::new('illustration')
                    ->setBasePath('uploads/')
                    ->setUploadDir('/public/uploads')
                    ->setFormTypeOptions(['required' => false])
                    ->setUploadedFileNamePattern('[contenthash].[extension]'),
                TextField::new('subtitle'),
                TextareaField::new('description'),
                BooleanField::new('isBest'),
                //BooleanField::new('isBest')->setFormTypeOptions([])
                MoneyField::new('price')->setCurrency('TND'),
                AssociationField::new('category'),
                HiddenField::new('owner')->setFormTypeOptions(['data' => $this->getUser()->getEmail()])
            ];
        }*/
        if ($this->getUser() == true) {
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                ImageField::new('illustration')
                    ->setBasePath('uploads/')
                    ->setUploadDir('/public/uploads')
                    ->setFormTypeOptions(['required' => false])
                    ->setUploadedFileNamePattern('[contenthash].[extension]'),
                TextField::new('subtitle'),
                TextareaField::new('description'),
                HiddenField::new('isBest')->setFormTypeOptions(['data'=>0]),
                MoneyField::new('price')->setCurrency('TND'),
                AssociationField::new('category'),
                HiddenField::new('owner')->setFormTypeOptions(['data' => $this->getUser()->getEmail()])
            ];
        } 
   
        else {
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                ImageField::new('illustration')
                    ->setBasePath('uploads/')
                    ->setUploadDir('/public/uploads')
                    ->setFormTypeOptions(['required' => false])
                    ->setUploadedFileNamePattern('[contenthash].[extension]'),
                TextField::new('subtitle'),
                TextareaField::new('description'),
                BooleanField::new('isBest'),
                MoneyField::new('price')->setCurrency('TND'),
                AssociationField::new('category'),
                HiddenField::new('owner')->setFormTypeOptions(['data' => 'admin'])
            ];
        }
    }

}