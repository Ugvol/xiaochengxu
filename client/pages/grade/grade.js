// pages/grade/grade.js
Page({
  
  /**
   * 页面的初始数据
   */
  data: {
    listData: [
      { "code": "见习", "text": '0-10' },
      { "code": "正式", "text": '11-30' },
      { "code": "知名", "text": '31-60' },
      { "code": "职业", "text": '61-100' },
      { "code": "著名", "text": '101-150' },
      { "code": "元老", "text": '151+' }
    ],
    designation: '见习', //用于显示输入语句  
    integral: '0',
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {
    var that=this;
    var oopenid = getApp().globalData.myopenid;
    if (oopenid) {
      wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_integral',
        data: {
          oopenid: oopenid
        },
        header: {
          'Content-Type': 'application/json'
        },
        success: function (res) {
          console.log(res.data);
          var odesi;
          if (res.data >= 0 && res.data <= 10) { odesi ='见习';}
          else if (res.data >= 11 && res.data <= 30) { odesi = '正式'; }
          else if (res.data >= 31 && res.data <= 60) { odesi = '知名'; }
          else if (res.data >= 61 && res.data <= 100) { odesi = '职业'; }
          else if (res.data >= 101 && res.data <= 150) { odesi = '著名'; }
          else if (res.data >= 151) { odesi = '元老'; }
          that.setData({
            designation: odesi,
            integral: res.data
          })
        }
      })
    }
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