![logo](https://user-images.githubusercontent.com/52301721/216746105-44a494e4-5dac-45e0-ac0c-8d330b5b1461.png)

# MySoundProfile
Spotifyの楽曲リストから自分の好みを把握する

```
$ composer install
```

# 実装済み機能
- お気に入りした曲を取得しDBに登録する
- これまで取得した曲を表示する
- 各特徴項目の値をDBから出力する
- 各特徴項目の平均値を出力する

# 実装予定
- 取得した結果を保存するためのログイン機能
- プレイリストからの曲の取得
- アーティスト名を日本語にする
- 各特徴指標についてヒストグラム化
- 類似した特徴指標を持つ楽曲をクラスタ化する
- 取得した好みや入力値（楽しい雰囲気の曲，邦楽のみなど）に基づいて，プレイリストを生成する

# 参考
https://developer.spotify.com/console/get-current-user-saved-tracks/?market=JP&limit=&offset=
https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-top-artists-and-tracks
