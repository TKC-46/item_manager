<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧表示ページ</title>
</head>
<body>
    @if (session()->has('success'))
        <div class="aleat aleat-success mt-5" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <h1>商品一覧表示ページ</h1>
    <h2>商品検索</h2>
    <form action="{{ route('item.index') }}" method="get">
        <div>
            <input type="text" name="name" placeholder="商品名">
            <input type="text" name="price" placeholder="値段">
            <button type="submit">検索</button>
        </div>
        <div>
            <a href="{{ route('item.index') }}">リセット</a>
            <a href="{{ route('item.showAdd') }}">新規登録</a>
        </div>
    </form>
    <div></div>
    <h2>商品一覧</h2>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>商品名</td>
                <td>価格</td>
                <td>カテゴリ</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <form action="{{ route('item.showEdit', $item) }}" method="get">
                            <input type="submit" value="編集">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('item.delete', $item) }}" method="post">
                            @csrf
                            <input type="submit" value="削除">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>