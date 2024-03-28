<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品新規登録ページ</title>
</head>
<body>
    <h1>商品新規登録ページ</h1>
    <form action="{{ route('item.add') }}" method="post">
        @csrf
        <div>
            <label>商品名</label>
        </div>
        <div>
            <input type="text" name="name"  value="{{ old('name') }}" placeholder="商品名を入力してください。">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>価格</label>
        </div>
        <div>
            <input type="number" name="price"  value="{{ old('price') }}" placeholder="価格を入力してください。">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>カテゴリ名</label>
        </div>
        <div>
            <!-- セレクトボックスでカテゴリ一覧から選択 -->
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (int)old('category_id') === $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="submit" name="send" value="登録">
        </div>
        <div>
            <a href="{{ route('item.index') }}">戻る</a>
        </div>
    </form>
</body>
</html>