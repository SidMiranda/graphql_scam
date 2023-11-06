<?php 
    
    
    function getCupom($c){

        $graphqlEndpoint = "https://magento.runningland.com.br/graphql";

        $variables = [
            "cartId" => "v31sIQ4a8PRPZz8uBIk1WaTuxTKve4ME",
            "couponCode" => $c
        ];

        $query = "mutation applyCouponToCart(\$cartId: String!, \$couponCode: String!) { ".
            "applyCouponToCart(input: {cart_id: \$cartId, coupon_code: \$couponCode}) { ".
            "cart { ".
                "id ".
                "...CartPageFragment ".
                "available_payment_methods { ".
                "code ".
                "title ".
                "__typename ".
                "} ".
                "__typename ".
            "} ".
            "__typename ".
            "} ".
        "} ".
        
        "fragment CartPageFragment on Cart { ".
            "id ".
            "total_quantity ".
            "...AppliedCouponsFragment ".
            "...GiftCardFragment ".
            "...ProductListingFragment ".
            "...PriceSummaryFragment ".
            "__typename ".
        "} ".
        
        "fragment AppliedCouponsFragment on Cart { ".
            "id ".
            "applied_coupons { ".
            "code ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment GiftCardFragment on Cart { ".
            "__typename ".
            "id ".
        "} ".
        
        "fragment ProductListingFragment on Cart { ".
            "id ".
            "items { ".
            "id ".
            "product { ".
                "id ".
                "name ".
                "sku ".
                "url_key ".
                "url_suffix ".
                "thumbnail { ".
                "url ".
                "__typename ".
                "} ".
                "small_image { ".
                "url ".
                "__typename ".
                "} ".
                "stock_status ".
                "... on ConfigurableProduct { ".
                "variants { ".
                    "attributes { ".
                    "uid ".
                    "__typename ".
                    "} ".
                    "product { ".
                    "id ".
                    "small_image { ".
                        "url ".
                        "__typename ".
                    "} ".
                    "__typename ".
                    "} ".
                    "__typename ".
                "} ".
                "__typename ".
                "} ".
                "__typename ".
            "} ".
            "prices { ".
                "price { ".
                "currency ".
                "value ".
                "__typename ".
                "} ".
                "__typename ".
            "} ".
            "quantity ".
            "... on ConfigurableCartItem { ".
                "configurable_options { ".
                "id ".
                "configurable_product_option_value_uid ".
                "option_label ".
                "value_id ".
                "value_label ".
                "__typename ".
                "} ".
                "__typename ".
            "} ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment PriceSummaryFragment on Cart { ".
            "id ".
            "items { ".
            "id ".
            "quantity ".
            "__typename ".
            "} ".
            "...ShippingSummaryFragment ".
            "prices { ".
            "...TaxSummaryFragment ".
            "...DiscountSummaryFragment ".
            "...GrandTotalFragment ".
            "...PrimeTotalFragment ".
            "...SubtotalFragment ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment DiscountSummaryFragment on CartPrices { ".
            "discounts { ".
            "amount { ".
                "currency ".
                "value ".
                "__typename ".
            "} ".
            "label ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment GrandTotalFragment on CartPrices { ".
            "grand_total { ".
            "currency ".
            "value ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment ShippingSummaryFragment on Cart { ".
            "id ".
            "shipping_addresses { ".
            "selected_shipping_method { ".
                "amount { ".
                "currency ".
                "value ".
                "__typename ".
                "} ".
                "__typename ".
            "} ".
            "street ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment TaxSummaryFragment on CartPrices { ".
            "applied_taxes { ".
            "amount { ".
                "currency ".
                "value ".
                "__typename ".
            "} ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment PrimeTotalFragment on CartPrices { ".
            "prime_total { ".
            "currency ".
            "value ".
            "__typename ".
            "} ".
            "__typename ".
        "} ".
        
        "fragment SubtotalFragment on CartPrices { ".
            "subtotal_excluding_tax { ".
            "currency ".
            "value ".
            "__typename ".
            "} ".
            "__typename ".
        "} ";
        

        $data = json_encode([
            'query' => $query, 
            'variables'=> $variables
        ]);

        $ch = curl_init($graphqlEndpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer vgvqa6hjy50aikfrf3ix8lfh5l98vqks'
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Erro na solicitação cURL: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;


    }

    function gerarCodigoAleatorio($tamanhoMaximo) {
        $caracteresPermitidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $codigoGerado = "";
    
        while (strlen($codigoGerado) < $tamanhoMaximo) {
            $caractereAleatorio = $caracteresPermitidos[rand(0, strlen($caracteresPermitidos) - 1)];
            $codigoGerado .= $caractereAleatorio;
        }
    
        return $codigoGerado;
    }
    
   
    $tamanhoMaximo = 6; // Tamanho máximo do código
    
    $codigoAleatorio = gerarCodigoAleatorio($tamanhoMaximo);
    echo getCupom($codigoAleatorio) . $codigoAleatorio;
    

?>