var qcloud = require('../../vendor/wafer2-client-sdk/index')
var config = require('../../config')
var util = require('../../utils/util.js')
Page({
  data: {
    showView:true,
    userInfo: {},
    logged: false,
    takeSession: false,
    requestResult: ''
  },
  // 用户登录示例
  bindGetUserInfo: function (e) {//点击按钮时触发
    var that= this;
    var openId = (wx.getStorageSync('openId'));
    //console.log(e.detail.userInfo)
    if (e.detail.userInfo) {//用户按了授权按钮
      if (openId) {//之前获取过openId
        that.setData({
          userInfo: e.detail.userInfo,
          logged: true,
          showView: false
        })
        console.log("登陆成功");
        getApp().globalData.myopenid = openId;

      }
      else{
        wx.login({
          success: function (res) {
            console.log(res.code);
            if (res.code) {
              var ocode=res.code;
              wx.getUserInfo({
                success: function (res_user) {
                  wx.request({
                    url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_user_list',
                    data: {
                      oocode: ocode
                    },
                    header: {
                      'Content-Type': 'application/json'
                    },
                    success: function (res) {
                      that.setData({
                        userInfo: e.detail.userInfo,
                        logged: true,
                        showView: false
                      })
                      wx.setStorageSync('openId', res.data);
                      console.log(res.data);//接收controller/sentencedata.php输出的openid
                      getApp().globalData.myopenid = res.data;//将openid赋给全局变量
                    },
                    fail:function(){
                      console.log("失败");
                    }
                  })
                },
                fail:function(){
                  console.log("失败");
                }
              })
            }
          }
        })
      }
    } else {
      //用户按了拒绝按钮
    }

  },
  /**
   * 页面的初始数据
   */


  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
   
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})