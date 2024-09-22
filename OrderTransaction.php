<?php

class OrderTransaction {

    public function getRecordQuery($tran_id)
    {
        $sql = "select * from payment WHERE transaction_id='" . $tran_id . "'";
        return $sql;
    }

    public function saveTransactionQuery($post_data)
    {
        $name = $post_data['cus_name'];
        $email = $post_data['cus_email'];
        $phone = $post_data['cus_phone'];
        $transaction_amount = $post_data['total_amount'];
        $transaction_id = $post_data['tran_id'];
        $currency = $post_data['currency'];
        $order_id = $post_data['order_id'];

        $sql = "INSERT INTO payment (order_id, name, email, phone, amount, status, transaction_id,currency)
                                    VALUES ('$order_id', '$name', '$email', '$phone','$transaction_amount','Pending', '$transaction_id','$currency')";

        return $sql;
    }

    public function updateTransactionQuery($tran_id, $type = 'Success')
    {
        $sql = "UPDATE payment SET status='$type' WHERE transaction_id='$tran_id'";

        return $sql;
    }
}

