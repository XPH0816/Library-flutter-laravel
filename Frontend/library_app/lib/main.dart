import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:library_app/Screens/Login/constants.dart';
import 'package:library_app/Screens/Signup/signup_screen.dart';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    SystemChrome.setEnabledSystemUIOverlays([SystemUiOverlay.top]);
    return MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Library App',
        theme: ThemeData(
          fontFamily: 'SFProDisplay',
          primaryColor: kPrimaryColor,
          scaffoldBackgroundColor: Colors.white,
        ),
        home: SignupScreen());
  }
}
