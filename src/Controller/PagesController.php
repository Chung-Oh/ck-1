<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function index()
    {
        // $pages = $this->Pages->find()->all();
        $this->paginate = [
            'limit' => 1
        ];
        $pages = $this->paginate($this->Pages);
        // $this->set(compact('pages'));
        $this->set('pages', $pages);
    }

    public function add()
    {
        $page = $this->Pages->newEntity();
        // $this->set(compact($page)); // Essa linha gera erro de variável
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success('Salvo com sucesso!');
                return $this->redirect(['controller' => 'pages', 'action' => 'index']);
            }
            $this->Flash->error('Falhou ao salvar, verifique os campos!');
        }
        $this->set('page', $page);
    }

    public function view($id)
    {
        $page = $this->Pages->get($id);
        // dd($page);
        $this->set('page', $page);
    }

    public function edit($id)
    {
        $page = $this->Pages->get($id);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success('Salvo com sucesso!');
                return $this->redirect(['controller' => 'pages', 'action' => 'index']);
            }
            $this->Flash->error('Falhou ao salvar, verifique os campos!');
        }
        $this->set('page', $page);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        $this->Pages->delete($page);
        $this->Flash->success('Removido com sucesso!');

        return $this->redirect(['action' => 'index']);
    }
}
