// pages/search/search.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    sosuoneirong: '',
    sentence: []
  },
  formSubmit: function (e) {
  var that = this;
  var formData = e.detail.value.osearch;
    wx.request({
      url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_search_list',
      data: {
        val: formData
      },
      header: {
        'Content-Type': 'application/json'
      },
      success: function (res) {
        console.log(res.data),
        that.setData({
          sentence: res.data
        })
      }
    })
  },
  formReset: function () {
    console.log('form发生了reset事件');
  },
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