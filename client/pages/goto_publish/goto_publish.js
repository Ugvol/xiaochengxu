Page({

  /**
   * 页面的初始数据
   */
  data: {
    casArray: ['励志', '情感', '家书', '呓语', '歌词', '台词', '书籍', '诗词'],
    casIndex: 0,
    hiddenToast: true 
  },
  formSubmit: function (e) {
    var that=this;
    var oopenid = getApp().globalData.myopenid; 
    var otextarea = e.detail.value.otext;
    var oauthor = e.detail.value.author;
    if (!oopenid){
      wx.showModal({
        title: '提示',
        content: '未登录',
      })
    }
    else if (!(otextarea)){
      wx.showModal({
        title: '提示',
        content: '句子为空',
      })
    }
    else if (oopenid && otextarea){
      var oleibie = e.detail.value.leibie;
      switch (oleibie) {
        case '励志':
          oleibie = 1;
          break;
        case '情感':
          oleibie = 2;
          break;
        case '家书':
          oleibie = 3;
          break;
        case '呓语':
          oleibie = 4;
          break;
        case '歌词':
          oleibie = 5;
          break;
        case '台词':
          oleibie = 6;
          break;
        case '书籍':
          oleibie = 7;
          break;
        case '诗词':
          oleibie = 8;
          break;
      }
      wx.request({
        url: 'https://6jvh6uvq.qcloud.la/index.php/sentencedata/get_publish_list',
        data: {
          otextarea: otextarea,
          oleibie: oleibie,
          oauthor: oauthor,
          oopenid: oopenid
        },
        header: {
          'Content-Type': 'application/json'
        },
        success: function (res) {
          console.log(res.data)
          that.setData({
            hiddenToast: !that.data.hiddenToast
          })
        }
      })
    }
  },
  thisfocus:function(){
    this.setData({
      write_sentence_value:""
    })
  },
  thatfocus: function () {
    this.setData({
      author_source_value: ""
    })
  },
  PickerChange: function (e) {
    this.setData({
      casIndex: e.detail.value
    })
  },
  // listenerButton: function () {
  //   this.setData({
  //     hiddenToast: !this.data.hiddenToast
  //   })
  // },
  toastHidden: function () {
    this.setData({
      hiddenToast: true
    })
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
    
  },
})