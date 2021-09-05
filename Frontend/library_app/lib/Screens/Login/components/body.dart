import 'package:flutter/material.dart';
import 'package:library_app/Screens/Login/components/background.dart';
import 'package:library_app/Screens/components/dotteddividerwithtext.dart';
import 'package:library_app/Screens/components/roundedbutton.dart';
import 'package:library_app/Screens/components/roundedpasswordtextfield.dart';
import 'package:library_app/Screens/components/roundedtextfield.dart';
import 'package:library_app/Screens/components/textbox.dart';

class Body extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    final double space = 0.04;
    return Background(
        child: SingleChildScrollView(
      reverse: true,
      padding: EdgeInsets.all(32),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Image.asset(
            "assets/images/Login-image.png",
            height: size.height * 0.3,
          ),
          SizedBox(
            height: size.height * space,
          ),
          TextBox(
            strArr: ["Welcome Back!", "Please, Log In."],
          ),
          SizedBox(
            height: size.height * (space - 0.03),
          ),
          RoundedTextField(hintText: "Username", space: space),
          RoundedPasswordTextField(space: space),
          SizedBox(
            height: size.height * (space - 0.01),
          ),
          RoundedButton(
            text: "Continue >",
            press: () {},
          ),
          SizedBox(
            height: size.height * space,
          ),
          DottedDividerWithText(
            text: "Or",
          ),
          SizedBox(
            height: size.height * space,
          ),
          RoundedButton(
            text: "Create an Account",
            press: () {
              Navigator.pop(context);
            },
            color: Colors.white.withOpacity(.28),
          )
        ],
      ),
    ));
  }
}
