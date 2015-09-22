//给你一个字符串，寻找该字符串中出现次数最多的字母和出现次数
<script>
var str = "abaasdffggghhjjkkgfddsssss";
     var arr = new Array();
     var i = 0;
     while (str.charAt(0)) {
         arr[i] = str.charAt(0) + "=" + (str.split(str.charAt(0)).length - 1);
         str = str.split(str.charAt(0)).join("");
         i++;
     }
     alert(arr);
     for (var j = 0,temp=0; j < arr.length; j++) {
         if (temp <= Number(arr[j].split("=")[1])) {
             temp = Number(arr[j].split("=")[1]);
             i = j;
         }
     }
     alert(arr[i]);
</script>

// js 利用sort进行排序
systemSort: function(array) {
    return array.sort(function(a, b) {
        return a - b;
    });
},
// 冒泡排序
bubbleSort: function(array) {
    var i = 0,
    len = array.length,
    j, d;
    for (; i < len; i++) {
        for (j = 0; j < len; j++) {
            if (array[i] < array[j]) {
                d = array[j];
                array[j] = array[i];
                array[i] = d;
            }
        }
    }
    return array;
},


//去掉数组中重复的元素
<script>
Array.prototype.strip = function() {
         if (this.length < 2) {
             return [this[0]] || [];
         }
         var arr = [];
         for (var i = 0; i < this.length; i++) {
             arr.push(this.splice(i--, 1));
             for (var j = 0; j < this.length; j++) {
                 if (this[j] == arr[arr.length - 1]) {
                     this.splice(j--, 1);
                 }
             }
         }
         return arr;
     };
     var a = ["abc", "abc", "a", "b", "c", "a", "b", "c"];
     alert(a.strip());
</script>