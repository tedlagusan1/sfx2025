<!DOCTYPE html>
<html>

<head>
    <title>New Product Created</title>
</head>

<body>
    <h2>Hello {{ $user->first_name }},</h2>
    <p>A new product has been created successfully:</p>

    <div style="margin: 20px 0; padding: 15px; border: 1px solid #ddd;">
        <h3>{{ $product->name }}</h3>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
    </div>

    <p>You can view the product details by clicking the link below:</p>

    <p>
        <a href="{{ url('/products/' . $product->id) }}">
            View Product Details
        </a>
    </p>

    <p>Best regards,<br>Your Application Team</p>
</body>

</html>
