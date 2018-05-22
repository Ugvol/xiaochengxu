Page({

  /**
   * 页面的初始数据
   */
  data: {
    sentence: []
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var oopenid = getApp().globalData.myopenid; 
    wx.request({
      url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_publication_list', 
      data: {
        oopenid: oopenid
      },
      header: {
        'content-type': 'application/json' // 默认值
      },
      success: res => {
        console.log(res.data),
        // console.log(res.data[0].sentence_id),
        this.setData({
          sentence: res.data
        })
      }
    })
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