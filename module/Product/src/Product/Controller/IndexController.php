<?php
namespace Product\Controller;

use Product\Entity\Product;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    
    public function IndexAction(){
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository('Product\Entity\Product');
        
        $products = $repository->findAll();
        
        $view_params = array(
        'products' => $products
        );
        return new ViewModel($view_params);
    }
    
    public function createAction(){
        
        if($this->request->isPost()){
            
            $name = $this->request->getPost('name');
            $price = $this->request->getPost('price');
            $description = $this->request->getPost('description');
            
            $product = new Product($name, $price, $description);
            
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            
            $entityManager->persist($product);
            $entityManager->flush();
            
            $this->flashMessenger()->addSuccessMessage('The product was succesfuly created!');    
        
            return $this->redirect()->toUrl('/Index/Index');
        }
        return new ViewModel();
    }
    public function removeAction(){
        
        if($this->request->isPost()){
            $id = $this->request->getPost('id');
            $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $repository = $entityManager->getRepository('Product\Entity\Product');
            
            $product = $repository->find($id);
            
            $entityManager->remove($product);
            $entityManager->flush();
            
            $this->flashMessenger()->addSuccessMessage('The product was succesfuly removed!');
            
            return $this->redirect()->toUrl('/Index/Index');
        }
        
        return new ViewModel();
    }
    
     public function editAction(){
        
        $id = $this->params()->fromRoute('id');
         
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $entityManager->getRepository('Product\Entity\Product');

        $product = $repository->find($id);
            
         if($this->request->isPost()){
            $id = $this->params()->fromPost('id');
            $product = $repository->find($id);
             
            $product->setName($this->request->getPost('name'));
            $product->setPrice($this->request->getPost('price'));
            $product->setDescription($this->request->getPost('description'));
            
            $entityManager->persist($product);
            $entityManager->flush();
            
            $this->flashMessenger()->addSuccessMessage('The product was succesfuly edited!');
             
            return $this->redirect()->toUrl('/Index/Index');
        }
         
        return new ViewModel(['product' => $product]);
    }
}