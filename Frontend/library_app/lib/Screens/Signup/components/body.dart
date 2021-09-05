import 'package:flutter/material.dart';
import 'package:library_app/Screens/Signup/components/background.dart';
import 'package:library_app/Screens/Signup/constants.dart';
import 'package:library_app/Screens/components/dotteddividerwithtext.dart';
import 'package:library_app/Screens/components/roundedbutton.dart';
import 'package:library_app/Screens/components/textbox.dart';
import 'package:library_app/Screens/components/textfieldcontainer.dart';
import 'package:library_app/Screens/components/textfieldcontent.dart';

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
            "assets/images/Signup-image.png",
            height: size.height * 0.3,
          ),
          SizedBox(
            height: size.height * space,
          ),
          TextBox(
            strArr: ["Hi there!", "Let's, Get Started"],
          ),
          SizedBox(
            height: size.height * (space - 0.03),
          ),
          TextFieldContainer(
            spaceBtwEach: size.height * (space - 0.02),
            child: TextFieldContent(
              icon: Icons.person_outlined,
              hintText: "Username",
            ),
          ),
          TextFieldContainer(
              spaceBtwEach: 0,
              child: TextFieldContent(
                  icon: Icons.vpn_key_outlined, hintText: "Password")),
          SizedBox(
            height: size.height * (space - 0.01),
          ),
          RoundedButton(
            text: "Create an Acount",
            press: () {},
            color: kSecondaryColor,
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
            text: "Log in",
            press: () {},
            color: Colors.white.withOpacity(.28),
          )
        ],
      ),
    ));
  }
}
