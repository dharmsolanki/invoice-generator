<?php

namespace frontend\controllers;

use app\models\Product;
use frontend\models\Invoice;
use Mpdf\Mpdf;
use Yii;
use yii\web\NotFoundHttpException;

class InvoiceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Invoice();
        return $this->render('index', ['model' => $model]);
    }

    public function actionCreateInvoice()
    {
        $postRequest = Yii::$app->request->post('Invoice');
        if (Yii::$app->request->isPost) {
            $model = new Invoice();
            $model->user_id = Yii::$app->user->identity->id;
            $model->customer_name = $postRequest['customer_name'];
            $model->customer_email = $postRequest['customer_email'];
            $model->invoice_date = $postRequest['invoice_date'];
            $model->amount = $postRequest['amount'];
            $model->save(false);

            // Save products
            $productNames = Yii::$app->request->post('Product')['name'];
            $productPrices = Yii::$app->request->post('Product')['price'];
            foreach ($productNames as $key => $productName) {
                $product = new Product();
                $product->name = $productName;
                $product->price = $productPrices[$key];
                $product->invoice_id = $model->id;
                $product->user_id = Yii::$app->user->identity->id;
                $product->save(false);
            }

            return $this->redirect(['site/index']);
        }
    }


    public function actionViewInvoice()
    {
        $model = Invoice::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        return $this->render('invoiceList', ['model' => $model]);
    }

    public function actionEdit($id)
    {
        $model = Invoice::find()->where(['id' => $id])->one();
        $products = Product::find()->where(['invoice_id' => $id])->all();
        $postRequest = Yii::$app->request->post('Invoice');
    
        if (Yii::$app->request->isPost) {
            $model->customer_name = $postRequest['customer_name'];
            $model->customer_email = $postRequest['customer_email'];
            $model->invoice_date = $postRequest['invoice_date'];
            $model->amount = $postRequest['amount'];
            $model->save(false);
    
            // Update products
            $productIds = Yii::$app->request->post('Product')['id'];
            $productNames = Yii::$app->request->post('Product')['name'];
            $productPrices = Yii::$app->request->post('Product')['price'];
            foreach ($productIds as $key => $productId) {
                $product = Product::findOne($productId);
                if ($product) {
                    $product->name = $productNames[$key];
                    $product->price = $productPrices[$key];
                    $product->save(false);
                }
            }
    
            return $this->redirect(['invoice/view-invoice']);
        }
    
        return $this->render('index', ['model' => $model, 'products' => $products]);
    }
    

    /**  
     * Delete  
     * @param integer $id  
     */
    public function actionDelete($id)
    {
        $model = Invoice::findOne($id);

        // $id not found in database   
        if ($model === null)
            throw new NotFoundHttpException('The requested page does not exist.');

        // delete record   
        $model->delete();

        return $this->redirect(['invoice/view-invoice']);
    }

    public function actionPrint($id)
    {
        $mpdf = new Mpdf();
        $model = Invoice::find()->where(['id' => $id])->one();
        $products = Product::find()->where(['invoice_id' => $id])->all();
        $invoiceContent = $this->renderPartial('_invoice_template', [
            'model' => $model,
            'products' => $products,
        ]);

        // Write the HTML content to the PDF
        $mpdf->WriteHTML($invoiceContent);

        // Output the PDF as an inline file
        $mpdf->Output($model->customer_name . '_invoice' . '.pdf', 'I'); // 'D' for force download, 'I' for inline
        exit;
    }
}
