WindowsでDocker環境を構築したことがないので、Windowsだと難しいかもしれません。

# 下準備

- DockerとDocker Composeをインストールする。
    - Mac: https://docs.docker.com/docker-for-mac/install/
    - Windows: https://docs.docker.com/docker-for-windows/install/
- Windowsの場合はmakeコマンドをインストールする
    - http://gnuwin32.sourceforge.net/packages/make.htm

# 使い方

1. ```.env.example```を```.env```にコピーする。
2. ```.env```を修正する。
    - 以下の項目のコメントアウトを解除する。
        - HOST_UID
        - VOLUME_CONSISTENCY
    - ターミナルで```$ id -u```を実行し、その結果を```HOST_UID=```の後に記述する。 
3. ターミナルでプロジェクトのディレクトリに移動する。
4. ターミナルで```$ make up```を実行する。
    - ポート関係のエラーが出たら、```.env```の```WEB_PORT```を8888等に変更する。
5. ターミナルで```$ make init```を実行する。
6. http://localhost にアクセスする。
    - ```WEB_PORT```を変更していた場合、「http://localhost:変更後のポート」にアクセスする。
