<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品編集ページ</title>
</head>
<body>
    <h1>商品編集ページ</h1>
    <form action="{{ route('item.edit', $item) }}" method="post">
        @csrf
        <div>
            <label>商品名</label>
        </div>
        <div>
            <input type="text" name="name" value="{{ $item->name }}" placeholder="商品名を入力">
        </div>
        <div>
            <label>価格</label>
        </div>
        <div>
            <input type="number" name="price" value="{{ $item->price }}" placeholder="価格を入力">
        </div>
        <div>
            <label>カテゴリ名</label>
        </div>
        <div>
            <select name="category_id">
                @foreach ($categories as $category)
                    @if ($category->id === $item->category_id)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @else
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" name="send" value="更新">
        </div>
        <div>
            <a href="{{ route('item.index') }}">戻る</a>
        </div>
    </form>
</body>
</html>