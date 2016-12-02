#__Casablanca__
ここではPHP製フレームワークである__Casablanca__の設計とversion管理、並びに、参考文献を記載する。

##__アイコン画像__
近日公開

##__Casablancaの設計思想__

##__概要説明__
MVCモデルに沿ったフレームワークを制作しながら、よりMVCの知識、並びにPHPのオブジェクト指向に対する知識をここでは勉強していく。
また、最終的には自分で制作したフレームワーク上に自分のwebアプリケーションを制作するまでが__完全目標とする。__

##__フレームワーク構造__

- **Request**
  - ユーザのリクエストを表すクラス。ユーザがリクエストした際の`GET`や`POST`パラメータURLを管理します。
- **Router**
  - ユーザがアクセサしたURLをRequestクラスから受け取り、どのコントローラを呼び出すかを決定します。これにより物理的なディレクトリ構造にに縛られないURL制御を可能にします。
- **Response**
  - リクエストに対するレスポンスです。最終的にユーザへ返すレスポンスの情報を管理します。
- **DbManager**
  - データベースへの接続情報や次に説明するDbRepositoryを管理するクラスです。
- **DbRepository**
  - 実際にデータベースのアクセスを伴う処理を管理するクラスです。実際にはデータベース上のテーブルごとにDbRepositoryクラスの子クラスを作成します。
今回のフレームワークでは__モデル__に相当します。
- **Contoller**
  - __モデル__や__ビュー__の制御を行うコントローラです。今回はこのControllerクラスの中に__アクション__と呼ばれるメソッドを定義していきます。
    アクションが実際に1画面に相当します。具体的な例を出すと、ユーザ情報を扱うコントローラをUserContollerクラスとして作成し、その中でユーザに対するアクション、例えばユーザ情報編集ならばeditAction(),ユーザ追加ならnewAction()というメソッドを定義していきます。
- **View**
  - 表示を制御するクラスです。ViewクラスにHTMLを書くわけではなく、HTMLが記述されたファイルの読み込みや変数の受け渡しをを行います。
- **Session**
  - セッションを管理するクラスです。
- **Application**
  - アプリケーション全体を表すクラスです。RequestクラスやSessionクラスの初期化、コントローラの実現などアプリケーションの全体の流れを管理します。
    アプリケーションごとにこのクラスを継承したクラスを定義し、アプリケーション固有の設定(データベース接続情報、URLとコントローラの対応など)の定義を行います。データベースの接続情報はDbManagerクラスにURLとコントローラの対応はRouteクラスにそれぞれ設定します。
- **ClassLoader**
  - クラスを定義したファイルを自動的に読み込むための__オーバロード__と言う仕組みを管理するクラス。オートローダとはクラスが必要な時に読み込むための仕組みです。定義されていないクラスを使おうとする時に、指定されたオートロード関数が呼び出されます。開発者はオートローダ関数の実装を適切にすることで、クラスが必要とされたタイミングで適切なクラスを読み込む処理を記述する事が可能である。
  - `__autload()`関数でもクラスやインターファイスのオーバロードが出来ますが,`spl_autoload_register()`関数が有効です。





##version管理
ver 0.01 [2016_0603]
- 大まかなファイルを追加
- 主に勉強しています

ver 0.1 [2016_0702]
- 骨組みのファイルは一通り完成。
- 各クラスやメソッドの遷移が頭で描けるように何度もこれから読む。
- PHPでの[オブジェクト指向](https://github.com/Fendo181/Casablanca_MVC/tree/master/PHPStudy)の概念の触りは理解できたが、まだまだ書いて理解する。

ver 0.12 [2016_0922]
- 余計なコメントを消去
- ブログサービスを実装した。

ver 0.13 [2016_1009]
- タイポやパスがあってなかった問題があったので、それを修正

ver 0.15 [2016_1114]
- autoloaderがはたらいていないので、修正しました。




##__参考文献__
>
パーフェクトPHP 5,6,7,8章(技術評論社)  
独習PHP 第3版  
[interfaceとは](http://blog.tojiru.net/article/377526320.html)
