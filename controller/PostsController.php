<?php

class PostsController extends Controller{

    function index(){
        $perPage = 4;
        $this->loadModel('Post');
        $condition = array('online'=>1,'type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'conditions'=> $condition,
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
        ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total'] / $perPage);
        $this->set($d);

    }
    
    function view($id, $slug){
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $d['post'] = $this->Post->findFirst(array(
            'fields' => 'id,slug,content,name',
            'conditions'=>array('online'=>1,'id'=>$id, 'type'=>'post')
        ));
        $e['comment'] = $this->Comment->find(array(
            'fields' => 'id,username,comment,created,ref,ref_id,state',
            'conditions' => array('ref'=>'posts', 'ref_id'=>$id),
        ));
        if(empty($d['post'])) {
        	$this->e404('Page Introuvable');
        }
        if ($slug != $d['post']->slug) {
            $this->redirect("posts/view/id:$id/slug:".$d['post']->slug,301);
        }

        $this->set($e);
        $this->set($d);

        if($this->request->data){
            if ($this->Comment->validates($this->request->data)) {
                $this->request->data->created = date('Y-m-d h:i:s');
                $this->request->data->ref = 'posts';
                $this->request->data->ref_id = $id; 
                $this->Comment->save($this->request->data);
 
                $this->Session->setFlash('Vous avez ajouté un commentaire ! Cepedant il pourra être modéré'); 
                $id = $this->Comment->id;
                $this->redirect("posts/view/id:".$d['post']->id."/slug:".$d['post']->slug);
            }
        }else{
            if ($id){
                $this->request->data = $this->Comment->findFirst(array(
                    'conditions' => array('id' => $id)
                ));
                $d['id'] = $id;
            }
        
        }

    }
    function signal($id, $ref_id){
        $this->loadModel('Comment');
        $this->loadModel('Post');
        $e['comment'] = $this->Comment->find(array(
            'fields' => 'id, state, ref_id',
        ));
        $conditionPost = array('type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'fields' => 'slug',
            'conditions' => $conditionPost
        ));
        $this->set($e);
        $this->set($d);
        $this->Comment->signal($id, $ref_id);
        $this->Session->setFlash('Le commentaire a été signalé');
        $this->redirect('admin/posts/comment');
        }

    /**
     * 
     * ADMIN
     */

    function admin_index(){
        $perPage = 110;
        $this->loadModel('Post');
        $conditionPost = array('type'=>'post');
        $d['posts'] = $this->Post->find(array(
            'fields' => 'id,name,online',
            'conditions'=> $conditionPost,
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
        ));
        
        $d['total'] = $this->Post->findCount($conditionPost);
        $d['page'] = ceil($d['total'] / $perPage);
    
        $this->set($d);

    }

    function admin_edit($id = null){
        $this->loadModel('Post');
        $d['id'] = '';
        
        if($this->request->data){
            if ($this->Post->validates($this->request->data)) {
                $this->request->data->type = 'post';
                $this->request->data->created = date('Y-m-d h:i:s');                
                $this->Post->save($this->request->data);
                
                $this->Session->setFlash('Le contenu a bien été modifié'); 
                $id = $this->Post->id;
                $this->redirect('admin/posts/index');
            }else{
                $this->Session->setFlash('Merci de corriger vos informations', 'errors'); 
            }

        }else{
            if ($id){
                $this->request->data = $this->Post->findFirst(array(
                    'conditions' => array('id' => $id)
                ));
                $d['id'] = $id;
            }
        
        }
        $this->set($d);
    }

    function admin_comment($id = null){
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $conditionPost = array('type'=>'post');
        $conditionComment = array('ref'=>'posts', 'state' =>0);
        $conditionCommentSignal = array('ref'=>'posts', 'state' =>1);
        $d['posts'] = $this->Post->find(array(
            'fields' => 'name, slug, id',
            'conditions' => $conditionPost
        ));
        $e['comment'] = $this->Comment->find(array(
            'fields' => 'id,username,comment,state,ref_id',
            'conditions'=> $conditionComment

        ));
        $f['commentSignal'] = $this->Comment->find(array(
            'fields' => 'id,username,comment,state,ref_id',
            'conditions'=> $conditionCommentSignal
        ));
        $e['total'] = $this->Comment->findCount($conditionComment);
        $f['totalSignal'] = $this->Comment->findCount($conditionCommentSignal);
        
        $this->set($e);
        $this->set($f);
        $this->set($d);  
    }

    function admin_commentAll($id = null)
    {
        $this->loadModel('Comment');
        $this->loadModel('Post');
        $conditionPost = array('type'=>'post');
        $e['comment'] = $this->Comment->find(array(
            'fields' => 'id,username,comment,created,state,ref_id',
            'conditions' => $conditionComment = array('ref'=>'posts')
        ));
        $d['posts'] = $this->Post->find(array(
            'fields' => 'name,id',
            'conditions' => $conditionPost
        ));
        $e['total'] = $this->Comment->findCount($conditionComment);
        $this->set($e);
        $this->set($d);
    }

    function admin_moderate($id, $ref_id){
        $this->loadModel('Comment');
        $e['comment'] = $this->Comment->find(array(
            'fields' => 'id, state, ref_id',
        ));
        $this->set($e);

        $this->Comment->moderate($id, $ref_id);
        $this->Session->setFlash('Le commentaire a été validé');
        $this->redirect('admin/posts/comment');
    }

    function admin_delete($id){
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $this->Post->delete($id);
        $this->Comment->delete($id);
        $this->Session->setFlash('L\'article a bien été supprimé'); 
        $this->redirect('admin/posts/index');
    }

    function admin_deleteComment($id){
        $this->loadModel('Comment');
        $this->Comment->delete($id);
        $this->Session->setFlash('Le commentaire a bien été supprimé'); 
        $this->redirect('admin/posts/comment');
    }
    
}