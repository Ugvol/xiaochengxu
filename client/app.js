//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index')
var config = require('./config')

App({
    onLaunch: function () {
        qcloud.setLoginUrl(config.service.loginUrl)
        // wx.login({
        //   success: function (res) {
        //     console.log(res.code);
        //     if (res.code) {
        //       wx.request({
        //         url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_user_list',
        //         data: {
        //           ocode: res.code
        //         },
        //         success: function (result) {
        //           console.log(result);
        //         }
        //       })
        //     } else {
        //       console.log('获取用户登录态失败!' + res.errMsg)
        //     }
        //   }
        // })
    }
})