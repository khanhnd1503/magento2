<?php
/**
 * Project_HelloWorld extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the Project License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.project.com/LICENSE.txt
 * 
 *                     @category  Project
 *                     @package   Project_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.project.com/LICENSE.txt
 */
namespace Project\HelloWorld\Controller\Adminhtml\Post;

class Delete extends \Project\HelloWorld\Controller\Adminhtml\Post
{
    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $name = "";
            try {
                /** @var \Project\HelloWorld\Model\Post $post */
                $post = $this->_postFactory->create();
                $post->load($id);
                $name = $post->getName();
                $post->delete();
                $this->messageManager->addSuccess(__('The Post has been deleted.'));
                $this->_eventManager->dispatch(
                    'adminhtml_project_helloworld_post_on_delete',
                    ['title' => $name, 'status' => 'success']
                );
                $resultRedirect->setPath('project_helloworld/*/');
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_project_helloworld_post_on_delete',
                    ['title' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('project_helloworld/*/edit', ['id' => $id]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Post to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('project_helloworld/*/');
        return $resultRedirect;
    }
}
