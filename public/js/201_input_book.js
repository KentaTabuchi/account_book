var input_form = new Vue({
  el:'#input_form',
  data:{
    //フォームの入力値
    category_balance:0,
    category_large:0,
    category_middle:0,
    category_small:0,
    memo:'',
    payment:0,

    //分類コードと分類名のリスト
    json_balance:[],
    json_large:[],
    json_middle:[],
    json_small:[],

    //このjs内でURLのリクエストパラメータを生成するために使用
    param:""
  },
  methods: {
    fetch: function($category){ 
      //URLリクエストパラメータを生成
      $param = "?code_balance=" + this.category_balance +
      "&code_large=" + this.category_large +
      "&code_middle=" + this.category_middle +
      "&code_small=" + this.category_small;
      this.param = $param;  

      //分類コードと分類名をjsonで取得
       axios.get('json_'+$category+this.param).then((res)=>{
        switch($category){
          case 'balance':
            this.json_balance = res.data;
          break;
          case 'large':
            this.json_large = res.data;
          break;
          case 'middle':
            this.json_middle = res.data;
          break;
          case 'small':
              this.json_small = res.data;
            break;
        }
      })
    },
    date_format: function(date,format){
      var format;
      format = format.replace(/YYYY/,date.getFullYear());
      format = format.replace(/MM/,date.getMonth()+1);
      format = format.replace(/DD/,date.getDate());
      return format;
    },
  },
  mounted:function(){
    //収支分類リストを取得しセレクトボックスに設定する
    this.fetch('balance');

    //セレクトボックスのデフォルト選択肢を設定
    this.category_balance=2;
  },
  watch:{
    category_balance:{
      handler:function(newVal,oldVal){
        //大分類リストを取得しセレクトボックスに設定する
        this.fetch('large');
        
        //セレクトボックスのデフォルト選択肢を設定
        switch (this.category_balance){
          case 1:this.category_large=11;break;
          case 2:this.category_large=22;break;
        }
      }
    },
    category_large:{
      handler:function(newVal,oldVal){
        //中分類リストを取得しセレクトボックスに設定する
        this.fetch('middle');

        //セレクトボックスのデフォルト選択肢を設定
        switch (this.category_large){
          case 11:this.category_middle=111;break;
          case 22:this.category_middle=221;break;
        }
      }
    },
    category_middle:{
      handler:function(newVal,oldVal){
        //小分類リストを取得しセレクトボックスに設定する
        this.fetch('small');
      }
    }, 
    payment:{
      handler:function(newVal,oldVal){
        this.payment = newVal.replace(/\D/g, '');
      }
    },
  }
})